export function criarCharacterBar(personagem, index, userName, ppt) {
    let charbar = document.createElement('div');
    charbar.className = 'mt-10';

    let name = "";
    if (personagem.name === "{NICKNAME}") {
        name = userName;
    }
    else {
        name = personagem.name;
    }
    name = name.slice(0, 19) + (name.length > 19 ? '...' : '');


    charbar.innerHTML = `
        <div class="character-bar ${personagem.rarity === 5 ? 'rarity-5' :
            personagem.rarity === 4 ? 'rarity-4' :
                'rarity-other'
        }">
            <div class="character-bar-container">
                <div class="d-flex">

                    <img
                        class="round-character-image"
                        src="https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/${personagem.icon}"
                    >

                    <p class="p-char-bar">
                        ${name}
                    </p>

                </div>
                <div class="d-flex relics-select">

                    <i data-lucide="circle-plus"></i>

                    <i data-lucide="circle-plus"></i>

                    <i data-lucide="circle-plus"></i>

                </div>

            </div>
        </div>
    `;

    return charbar;
}