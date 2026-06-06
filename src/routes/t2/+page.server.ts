import { fail, redirect } from "@sveltejs/kit";
import type { PageServerLoad, Actions } from "./$types";

export const load: PageServerLoad = async () => {

};

export const actions: Actions = {

	login: async ({ request, cookies }) => {
		const formData = await request.formData();

		const uid = formData.get("uid")?.toString().trim();

		if (!uid) {
			return fail(400, {
				success: false,
				error: "Informe seu UID para continuar.",
				uid
			});
		}

		const resposta = await fetch(
			`https://api.mihomo.me/sr_info_parsed/${uid}?lang=en`
		);
		const dados = await resposta.json();

		if (dados.detail) {
			return fail(400, {
				success: false,
				error: "Informe um UID válido.",
				uid
			});
		}

		cookies.set("session", JSON.stringify({
			uid: uid || "",
			userName: "Usuario " + uid,
		}), {
			path: "/",
			httpOnly: true,
			sameSite: "strict",
			maxAge: 60 * 60 * 24
		});


		throw redirect(303, "/");
	}

};