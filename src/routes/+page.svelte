<script lang="ts">
  let { form } = $props();
</script>

<svelte:head>
  <title>Login</title>
</svelte:head>

<div class="layout">
  <main class="content">
    <section class="page-content">

      <div class="total-card login-card">
        <div class="login-card-header">
          <h3>Acessar sistema</h3>
          <p>Informe seu UID para iniciar</p>
        </div>

		{#if form?.error}
          <div class="error-message">
            {form.error}
          </div>
        {/if}

        <form method="POST" action="?/login" class="login-form">
          <label class="login-field" for="uid">
            <span>UID</span>
            <input
              id="uid"
              type="text"
              name="uid"
              placeholder="Digite seu UID"
              value={form?.uid ?? ""}
            />
          </label>

          <button class="login-button" type="submit"> Entrar </button>
        </form>
      </div>
	  
    </section>
  </main>
</div>

<style>
  .total-card {
    box-sizing: border-box;
    background: white;
    border: 1px solid #dfe5eb;
    border-radius: 8px;
    box-shadow: 0 12px 28px rgba(15, 23, 42, 0.04);
  }

  .layout {
    display: flex;
    min-height: 100vh;
  }

  .content {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .page-content {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 2rem;
  }

  @media (max-width: 1200px) {
    .layout {
      flex-direction: column;
    }
  }

  .login-card {
    width: 100%;
    max-width: 420px;
    margin: 2rem auto 0;
    padding: 2rem;
  }

  .login-card-header {
    margin-bottom: 1.75rem;
  }

  .login-card-header h3 {
    margin: 0;
    color: #172033;
    font-size: 1.55rem;
    font-weight: 800;
  }

  .login-card-header p {
    margin: 0.45rem 0 0;
    color: #64748b;
    font-size: 0.95rem;
  }

  .login-form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
  }

  .login-field {
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
  }

  .login-field span {
    color: #172033;
    font-size: 0.9rem;
    font-weight: 700;
  }

  .login-field input {
    width: 100%;
    height: 48px;
    box-sizing: border-box;
    border: 1px solid #d7dee7;
    border-radius: 8px;
    padding: 0 1rem;
    color: #1f2937;
    font: inherit;
    font-size: 0.95rem;
    outline: none;
    background: #ffffff;
    transition:
      border-color 0.2s,
      box-shadow 0.2s;
  }

  .login-field input:focus {
    border-color: #00aaa8;
    box-shadow: 0 0 0 3px rgba(0, 180, 182, 0.12);
  }

  .login-button {
    height: 50px;
    margin-top: 0.5rem;
    border: none;
    border-radius: 8px;
    background: linear-gradient(90deg, #161618, #1b1b1f);
    color: white;
    font: inherit;
    font-size: 0.95rem;
    font-weight: 800;
    cursor: pointer;
    transition:
      transform 0.15s,
      opacity 0.2s;
    box-shadow: 0 8px 16px rgba(0, 143, 141, 0.22);
  }

  .login-button:hover {
    opacity: 0.95;
    transform: translateY(-1px);
  }

  .login-button:active {
    transform: translateY(0);
  }

  .error-message {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 1rem;
  }
</style>
