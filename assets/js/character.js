import { criarCharacterCard } from '../../components/character_card.js';

document.getElementById('loader').style.display = 'flex';
document.getElementById('dashboard-content').style.display = 'none';

async function carregarDados() {

    const params = new URLSearchParams(window.location.search);
    const characterId = params.get('id');
    const resposta = await fetch(`api/character.php?id=${characterId}`);

    const dados = await resposta.json();
    console.log(dados);

    const charactersDiv = document.getElementById('characters');
    charactersDiv.innerHTML = '';

    dados.forEach((personagem, index) => {

        const div = document.createElement('div');

        if (personagem.rarity === 5) {
            div.className = "character-preview-card rarity-5";
        } else if (personagem.rarity === 4) {
            div.className = "character-preview-card rarity-4";
        } else {
            div.className = "character-preview-card rarity-other";
        }

        const img2 = document.createElement('img');
        img2.src = "https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/" + personagem.portrait;
        img2.className = "character-preview-image";
        div.appendChild(img2);

        charactersDiv.appendChild(div);

    });

    document.getElementById('loader').style.display = 'none';
    document.getElementById('dashboard-content').style.display = 'block';
}

carregarDados();