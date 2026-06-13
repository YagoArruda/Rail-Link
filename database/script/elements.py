import json
import mysql.connector
from dotenv import load_dotenv
import os

# Carrega o .env
load_dotenv()

conn = mysql.connector.connect(
    host= os.getenv("DB_HOST"),
    user= os.getenv("DB_USER"),
    password= os.getenv("DB_PASSWORD"),
    database= os.getenv("DB_DATABASE")
)

cursor = conn.cursor()

json_path = os.path.join("..", "json", "elements.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for element_id, element in data.items():

    sql = """
    INSERT INTO rail_elements (
        element_id,
        name,
        description,
        color,
        icon
    )
    VALUES (%s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        name = VALUES(name),
        description = VALUES(description),
        color = VALUES(color),
        icon = VALUES(icon)
    """

    values = (
        element["id"],
        element["name"],
        element["desc"],
        element["color"],
        element["icon"]
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")