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

json_path = os.path.join("..", "json", "character_ranks.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for character_id, character in data.items():

    sql = """
    INSERT INTO rail_character_ranks (
        character_ranks_id,
        name,
        character_rank,
        description,
        materials,
        level_up_skills,
        icon
    )
    VALUES (%s, %s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        character_ranks_id = VALUES(character_ranks_id),
        name = VALUES(name),
        character_rank = VALUES(character_rank),
        description = VALUES(description),
        materials = VALUES(materials),
        level_up_skills = VALUES(level_up_skills),
        icon = VALUES(icon)
    """

    values = (
        int(character["id"]),
        character["name"],
        int(character["rank"]),
        character["desc"],
        json.dumps(character["materials"]),
        json.dumps(character["level_up_skills"]),
        character["icon"]
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")