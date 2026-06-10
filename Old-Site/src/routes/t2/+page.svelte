<script lang="ts">
	let { data } = $props();

  import Loading from "$lib/components/loading/loading.svelte";
</script>

<svelte:head>
  <title>T2</title>
</svelte:head>

<h1>T2</h1>

<div class="loader">
<Loading />
</div>

<style>
.loader{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 50vh;
}

</style>