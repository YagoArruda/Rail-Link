<script lang="ts">
	let { data } = $props();
</script>

<h1>{data.dados.player.nickname}</h1>
<p>{data.dados.player.signature}</p>
<p>Level: {data.dados.player.level}</p>
<h1>Personagens</h1>
<p>{data.dados.player.uid}</p>
<p>1 - {data.dados.characters[0].name} - {data.dados.characters[0].level}</p>
<p>2 - {data.dados.characters[1].name} - {data.dados.characters[1].level}</p>
<p>3 - {data.dados.characters[2].name} - {data.dados.characters[2].level}</p>
<p>4 - {data.dados.characters[3].name} - {data.dados.characters[3].level}</p>
<p>5 - {data.dados.characters[4].name} - {data.dados.characters[4].level}</p>
<p>6 - {data.dados.characters[5].name} - {data.dados.characters[5].level}</p>
<p>7 - {data.dados.characters[6].name} - {data.dados.characters[6].level}</p>
<p>8 - {data.dados.characters[7].name} - {data.dados.characters[7].level}</p>
