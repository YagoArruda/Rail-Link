import { fail, redirect } from '@sveltejs/kit';

export async function load({ cookies }) {
	const cookie = cookies.get("session");

let session = null;

	if (cookie) {
        try {
            session = JSON.parse(cookie);
        } catch {
            session = null;
        }
    }

	if (!session?.uid) {
		throw redirect(303, "/login");
	}

	const resposta = await fetch(
		`https://api.mihomo.me/sr_info_parsed/${session.uid}?lang=en`
	);

	const dados = await resposta.json();

	return {
		dados,
		hideShell: session.uid == null,
	};
}