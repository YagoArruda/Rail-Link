<script lang="ts">
  import "./layout.css";
  import { Hexagon } from "@lucide/svelte";
  import { page } from "$app/stores";

  let { data, children } = $props();

  const menuItems = [
    {
      label: "Dashboard",
      icon: Hexagon,
      href: "/dashboard",
    },
    {
      label: "Personagens",
      icon: Hexagon,
      href: "/personagens",
    },
    {
      label: "Artefatos",
      icon: Hexagon,
      href: "/artefatos",
    },
    {
      label: "Estruturas",
      icon: Hexagon,
      href: "/estruturas",
    },
  ];
</script>

{#if !data.hideShell}
  <div class="layout">
    <header class="topbar">
      <div class="topbar-cut"></div>
    </header>

    <div class="workspace">
      <aside class="sidebar">
        <nav class="side-menu" aria-label="Menu principal">
          {#each menuItems as item}
            {@const Icon = item.icon}
            <a
              class="side-menu-item"
              class:active={$page.url.pathname === item.href}
              href={item.href}
            >
              <Icon size={21} />

              <span>{item.label}</span>
            </a>
          {/each}
        </nav>
      </aside>

      <main class="content">
        <section class="page-slot">
          {@render children?.()}
        </section>
      </main>
    </div>
  </div>
{:else}
  <div class="layout">
    <header class="topbar">
      <div class="topbar-cut"></div>
    </header>

    {@render children?.()}
  </div>
{/if}

<style>
  :global(body) {
    margin: 0;
    background: #1b1b1f;
    font-family: Inter, sans-serif;
    color: rgba(255, 255, 255, 0.86);
  }

  .layout {
    min-height: 100vh;
    /*background: #f7f9fc;
    color: #172033;*/
    font-family: Inter, Arial, sans-serif;
  }

  .topbar {
    position: relative;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    overflow: hidden;
    background: linear-gradient(90deg, #161618 0%, #1b1b1f 58%, #f82c36 100%);
    /*border-bottom: 3px solid #00b4b6; trocar cor*/
    border-bottom: 3px solid #f82c36;
  }

  /*possivel remover depois*/
  .topbar-cut {
    position: absolute;
    right: 18%;
    width: 360px;
    height: 180px;
    /*background: #f82c36;*/
    transform: skewX(-42deg);
  }

  .workspace {
    display: grid;
    /*grid-template-columns: 190px minmax(0, 1fr);*/
    grid-template-columns: 160px minmax(0, 1fr);
    min-height: calc(100vh - 72px);
    min-width: 0;
  }

  .sidebar {
    min-width: 0;
    background: #161618;
    /*background: linear-gradient(180deg, #172833 0%, #0c1b24 100%);
    color: white;
    border-right: 4px solid #00b4b6;*/
  }

  .side-menu {
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
    padding: 1.8rem 0;
  }

  .side-menu-item {
    height: 48px;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0 1.55rem;
    color: rgba(255, 255, 255, 0.86);
    /*font-size: 0.9rem;*/
    font-size: 0.8rem;
    text-decoration: none;
    transition:
      background 0.2s,
      color 0.2s;
  }

  .side-menu-item:hover {
    background: rgba(255, 255, 255, 0.06);
  }

  .side-menu-item.active {
    color: #f82c36;
  }

  .content,
  .page-slot {
    min-width: 0;
  }

  .page-slot {
    padding: 1rem 1.35rem 2rem;
  }

  @media (max-width: 1100px) {
    .workspace {
      grid-template-columns: 1fr;
    }

    .sidebar {
      border-right: none;
      border-bottom: 4px solid #00b4b6;
      overflow: hidden;
    }

    .side-menu {
      flex-direction: row;
      overflow-x: auto;
      padding: 0.65rem 0.75rem;
      scrollbar-width: none;
    }

    .side-menu::-webkit-scrollbar {
      display: none;
    }

    .side-menu-item {
      height: 42px;
      padding: 0 0.9rem;
      flex-shrink: 0;
      border-radius: 8px;
    }
  }

  @media (max-width: 720px) {
    .topbar {
      height: auto;
      min-height: 82px;
      padding: 1rem;
      align-items: flex-start;
      flex-direction: column;
      gap: 0.9rem;
    }

    .topbar-cut {
      right: -120px;
      top: -30px;
    }
  }
</style>
