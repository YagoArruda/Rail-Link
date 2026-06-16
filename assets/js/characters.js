import { criarCharacterCard } from '../../components/character_card.js';

document.getElementById('loader').style.display = 'flex';
document.getElementById('dashboard-content').style.display = 'none';

async function carregarDados() {

    const userName = window.userName;
    
    const resposta = await fetch('api/characters.php');

    const dados = await resposta.json();

    const charactersDiv = document.getElementById('characters');
    charactersDiv.innerHTML = '';

    dados.forEach((personagem, index) => {

        charactersDiv.appendChild(
            criarCharacterCard(
                personagem,
                index,
                window.userName,
                false
            )
        );

    });

    document.getElementById('loader').style.display = 'none';
    document.getElementById('dashboard-content').style.display = 'block';
}

carregarDados();