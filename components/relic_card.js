export function criarRelicCard(cardInfo, index, userName) {

    const div = document.createElement('div');

    let name = "";
    name = cardInfo.name;
    name = name.slice(0, 6) + (name.length > 6 ? '...' : '');

    div.className =
        cardInfo.rarity === 5 ? 'relic-card rarity-5' :
            cardInfo.rarity === 4 ? 'relic-card rarity-4' :
                'relic-card rarity-other';

    div.innerHTML = `
        <div class="character-image-container">
            <img
                class="character-image"
                src="https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/${cardInfo.icon}"
            >

            <p class="p-char-card">
                ${name}
            </p>
        </div>
    `;

    return div;
}