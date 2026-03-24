<!-- <footer class="app-footer">
   <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
    The current link item
  </a>
  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
  <a href="#" class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a>
</div>
</footer> -->

<footer class="footer-pro">
  <div id="tsparticles-footer"></div>
    <div class="footer-container">

        <!-- LOGO -->
        <div class="footer-brand">
            <img src="{{ asset('images/Logo__vertical.png') }}" alt="logo">
            <h3>InSign</h3>
            <p>Aprende lenguaje de señas de forma interactiva</p>
        </div>

        <!-- LINKS -->
        <div class="footer-links">
            <h4>Explorar</h4>
            <a href="#">Inicio</a>
            <a href="#">Categorías</a>
            <a href="#">Buscar</a>
        </div>

        <!-- INFO -->
        <div class="footer-links">
            <h4>Información</h4>
            <a href="#">Sobre nosotros</a>
            <a href="#">Contacto</a>
            <a href="#">Términos</a>
        </div>

        <!-- SOCIAL -->
        <div class="footer-social">
            <h4>Síguenos</h4>
            <div class="social-icons">
              <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-whatsapp"></i></a>
                  <a href="#"><i class="fas fa-envelope"></i></a>
              </div>
            </div>
        </div>

        <div class="footer-newsletter">
          <h4>Suscríbete</h4>

          <div class="newsletter-box">
              <input type="email" placeholder="Tu correo">
              <button>Enviar</button>
          </div>
      </div>

    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} InSign - Todos los derechos reservados
    </div>

</footer>