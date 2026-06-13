import { criarCharacterCard } from '../../components/character_card.js';

document.getElementById('loader').style.display = 'flex';
document.getElementById('dashboard-content').style.display = 'none';

async function carregarDados() {

    const resposta = await fetch('api/player.php');
    const dados = await resposta.json();

    document.getElementById('nickname').textContent = dados.player.nickname;
    document.getElementById('signature').textContent = dados.player.signature;
    document.getElementById('level').textContent = dados.player.level;
    //document.getElementById('uid').textContent = dados.player.uid;
    document.getElementById('avatar').src = "https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/" + dados.player.avatar.icon;

    const charactersDiv = document.getElementById('characters');
    charactersDiv.innerHTML = '';

    dados.characters.forEach((personagem, index) => {

        charactersDiv.appendChild(
            criarCharacterCard(
                personagem,
                index,
                window.userName
            )
        );

    });
    document.getElementById('loader').style.display = 'none';
    document.getElementById('dashboard-content').style.display = 'block';
}

carregarDados();