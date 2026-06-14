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

json_path = os.path.join("..", "json", "character_promotions.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for character_id, character in data.items():

    sql = """
    INSERT INTO rail_character_promotions (
        character_promotion_id,
        promotion_values,
        materials
    )
    VALUES (%s, %s, %s)
    ON DUPLICATE KEY UPDATE
        character_promotion_id = VALUES(character_promotion_id),
        promotion_values = VALUES(promotion_values),
        materials = VALUES(materials)
    """

    values = (
        int(character["id"]),
        json.dumps(character["values"]),
        json.dumps(character["materials"])
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")