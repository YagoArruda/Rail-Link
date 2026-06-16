export function criarCharacterCard(personagem, index, userName, ppt) {

    const link = document.createElement('a');

    link.href = `character.php?id=${personagem.character_id || personagem.id}&ppt=${ppt}`;
    link.className = 'character-link';

    let name = "";
    if (personagem.name === "{NICKNAME}") {
        name = userName;
    }
    else {
        name = personagem.name;
    }
    name = name.slice(0, 19) + (name.length > 19 ? '...' : '');

    link.innerHTML = `
        <div class="character-card ${
            personagem.rarity === 5 ? 'rarity-5' :
            personagem.rarity === 4 ? 'rarity-4' :
            'rarity-other'
        }">
            <div class="character-image-container">
                <img
                    class="character-image"
                    src="https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/${personagem.icon}"
                >

                <p class="p-char-card">
                    ${index + 1} - ${name}
                </p>
            </div>
        </div>
    `;

    return link;
}