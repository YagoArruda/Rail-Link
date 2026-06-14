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

json_path = os.path.join("..", "json", "avatars.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for avatar_id, avatar in data.items():

    sql = """
    INSERT INTO rail_avatars (
        avatar_id,
        name,
        icon
    )
    VALUES (%s, %s, %s)
    ON DUPLICATE KEY UPDATE
        avatar_id = VALUES(avatar_id),
        name = VALUES(name),
        icon = VALUES(icon)
    """

    values = (
        int(avatar["id"]),
        avatar["name"],
        avatar["icon"]
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")