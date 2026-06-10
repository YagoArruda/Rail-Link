import { json } from '@sveltejs/kit';

export async function GET({ cookies }) {
	const cookie = cookies.get('session');

	if (!cookie) {
		return json({ error: 'Não autenticado' }, { status: 401 });
	}

	const session = JSON.parse(cookie);

	const resposta = await fetch(
		`https://api.mihomo.me/sr_info_parsed/${session.uid}?lang=en`
	);

	const dados = await resposta.json();

	return json(dados);
}