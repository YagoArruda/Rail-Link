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

json_path = os.path.join("..", "json", "characters.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for character_id, character in data.items():

    sql = """
    INSERT INTO rail_character (
        character_id,
        name,
        tag,
        rarity,
        path,
        element,
        max_sp,
        ranks,
        skills,
        skill_trees,
        icon,
        preview,
        portrait
    )
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    tag = VALUES(tag),
    rarity = VALUES(rarity),
    path = VALUES(path),
    element = VALUES(element),
    max_sp = VALUES(max_sp),
    ranks = VALUES(ranks),
    skills = VALUES(skills),
    skill_trees = VALUES(skill_trees),
    icon = VALUES(icon),
    preview = VALUES(preview),
    portrait = VALUES(portrait)
    """

    values = (
        int(character["id"]),
        character["name"],
        character["tag"],
        character["rarity"],
        character["path"],
        character["element"],
        character["max_sp"],
        json.dumps(character["ranks"]),
        json.dumps(character["skills"]),
        json.dumps(character["skill_trees"]),
        character["icon"],
        character["preview"],
        character["portrait"]
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")