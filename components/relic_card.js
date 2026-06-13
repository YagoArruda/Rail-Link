export function criarCharacterCard(personagem, index, userName) {

    const div = document.createElement('div');

    div.className =
        personagem.rarity === 5 ? 'character-card rarity-5' :
        personagem.rarity === 4 ? 'character-card rarity-4' :
        'character-card rarity-other';

    div.innerHTML = `
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
    `;

    return div;
}