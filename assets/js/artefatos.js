import { criarCharacterCard } from '../../components/character_card.js';

document.getElementById('loader').style.display = 'flex';
document.getElementById('dashboard-content').style.display = 'none';

async function carregarDados() {

    //const userName = <?= json_encode($_SESSION['userName']) ?>;
    const userName = window.userName;
    
    const resposta = await fetch('api/relic_sets.php');

    const dados = await resposta.json();

    console.log(dados);

    //document.getElementById('nickname').textContent = dados.player.nickname;
    //document.getElementById('signature').textContent = dados.player.signature;
    //document.getElementById('level').textContent = dados.player.level;
    ////document.getElementById('uid').textContent = dados.player.uid;
    //document.getElementById('avatar').src = "https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/" + dados.player.avatar.icon;

    const charactersDiv = document.getElementById('characters');
    charactersDiv.innerHTML = '';

    dados.forEach((personagem, index) => {

        const div = document.createElement('div');
        //div.className = "character-card";
        //div.className = "character-image-container";

        const container = document.createElement('div');
        container.className = 'character-image-container-in';

        if (personagem.rarity === 5) {
            div.className = "character-card rarity-5";
        } else if (personagem.rarity === 4) {
            div.className = "character-card rarity-4";
        } else {
            div.className = "character-card rarity-other";
        }

        const p = document.createElement('p');
        let name = "";

        if (personagem.name == "{NICKNAME}") {
            name = `${index + 1} - ${userName}`;
        } else {
            name = `${index + 1} - ${personagem.name}`;
        }

        if (name.length > 25) {
            name = name.substring(0, 22) + '...';
        }

        p.textContent = name;
        p.className = "p-char-card";

        //charactersDiv.appendChild(p); 
        //div.appendChild(p);

        const img = document.createElement('img');
        img.src = "https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/" + personagem.icon;
        //charactersDiv.appendChild(img);
        img.className = "character-image";
        //div.appendChild(img);

        container.appendChild(img);
        container.appendChild(p);

        div.appendChild(container);

        charactersDiv.appendChild(div);

    });

    document.getElementById('loader').style.display = 'none';
    document.getElementById('dashboard-content').style.display = 'block';
}

carregarDados();