<template>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Login</div>

				<div class="card-body">
					<form @submit.prevent="submitLogin">
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

							<div class="col-md-6">
								<input
									id="email"
									type="email"
									class="form-control"
                  :class="{'is-invalid' : authError}"
									name="email"
									value
									required
									autocomplete="email"
									autofocus
								/>
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

							<div class="col-md-6">
								<input
									id="password"
									type="password"
									class="form-control"
                  :class="{'is-invalid' : authError}"
									name="password"
									required
									autocomplete="current-password"
								/>
								<span class="invalid-feedback" role="alert" v-if="authError">
									<strong>Wrong email or password </strong>
								</span>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
	name: "Login",
	methods: {
		...mapActions(["login"]),
		async submitLogin() {
			let email = document.getElementById("email").value;
			let password = document.getElementById("password").value;

			let credentials = {
				email,
				password,
			};

			this.login(credentials);
		},
  },
  computed: mapGetters({
    authError: "getAuthError",
  }),
};
</script>
