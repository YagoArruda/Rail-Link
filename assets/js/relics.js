import { criarRelicCard } from '../../components/relic_card.js';

document.getElementById('loader').style.display = 'flex';
document.getElementById('dashboard-content').style.display = 'none';

async function carregarDados() {

    const userName = window.userName;
    
    const resposta = await fetch('api/relic_sets.php');

    const dados = await resposta.json();

    const cardsDiv = document.getElementById('cards');
    cardsDiv.innerHTML = '';

    dados.forEach((cardInfo, index) => {

        cardsDiv.appendChild(
            criarRelicCard(
                cardInfo,
                index,
                window.userName
            )
        );

    });

    document.getElementById('loader').style.display = 'none';
    document.getElementById('dashboard-content').style.display = 'block';
}

carregarDados();