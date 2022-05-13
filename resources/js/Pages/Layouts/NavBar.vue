<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container-fluid">
      <Link class="navbar-brand" href="/">AsKUNeeD</Link>
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-end me-5" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <Link class="nav-link" aria-current="page" href="/">Home</Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" href="/?type=answer">Answer Question</Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" href="/?type=unanswer">Unanswer Question</Link>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdownMenuLink"
              role="button"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
            >
              Profile
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li>
                <a class="dropdown-item" href="/profile/user">{{ $page.props.auth_user.name }}</a>
              </li>
              <li>
                <Link class="dropdown-item" href="/profile/edit">Edit Profile</Link>
              </li>
              <li>
                <Link class="dropdown-item" href="/logout">Logout</Link>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

export default {
  components: { Link },
};
</script>

<style lang="scss" scoped>
</style>