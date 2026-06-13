export function criarCharacterCard(personagem, index, userName) {

    const link = document.createElement('a');

    link.href = `character.php?id=${personagem.character_id}`;
    link.className = 'character-link';

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
                    ${index + 1} - ${
                        personagem.name === "{NICKNAME}"
                            ? userName
                            : personagem.name
                    }
                </p>
            </div>
        </div>
    `;

    return link;
}