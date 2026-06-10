<script lang="ts">
  import { onMount } from "svelte";

  import Loading from "$lib/components/loading/loading.svelte";

  let { data } = $props();

  const uid = data.uid;
  let dados = $state<any>(null);
  let carregando = $state(true);

  onMount(async () => {
    const resposta = await fetch("/api/player");
    dados = await resposta.json();
    carregando = false;
  });
</script>

<svelte:head>
  <title>Dashboard</title>
</svelte:head>

<h1>Dashboard</h1>
{#if carregando}
  <div class="loader">
    <Loading />
  </div>
{:else if dados}
  <h1>{dados.player.nickname}</h1>
  <p>{dados.player.signature}</p>
  <p>Level: {dados.player.level}</p>
  <h1>Personagens</h1>
  <p>{dados.player.uid}</p>
  <p>1 - {dados.characters[0].name} - {dados.characters[0].level}</p>
  <p>2 - {dados.characters[1].name} - {dados.characters[1].level}</p>
  <p>3 - {dados.characters[2].name} - {dados.characters[2].level}</p>
  <p>4 - {dados.characters[3].name} - {dados.characters[3].level}</p>
  <p>5 - {dados.characters[4].name} - {dados.characters[4].level}</p>
  <p>6 - {dados.characters[5].name} - {dados.characters[5].level}</p>
  <p>7 - {dados.characters[6].name} - {dados.characters[6].level}</p>
  <p>8 - {dados.characters[7].name} - {dados.characters[7].level}</p>
{/if}

<style>
  .loader {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50vh;
  }
</style>
