<section class="contacto-container">
  <h2>Contáctanos</h2>
  <form method="POST" action="#">
    <input type="text" name="nombre" placeholder="Tu nombre" required>
    <input type="email" name="correo" placeholder="Tu correo" required>
    <textarea name="mensaje" placeholder="Mensaje" rows="5" required></textarea>
    <button type="submit" class="btn-contacto">Enviar</button>
  </form>
</section>

<style>
.contacto-container {
  max-width: 420px;
  margin: 50px auto 0 auto;
  background: #f8f9fa;
  padding: 36px 32px 28px 32px;
  border-radius: 14px;
  box-shadow: 0 4px 24px rgba(0,123,255,0.08);
  font-family: Arial, sans-serif;
  text-align: center;
}
.contacto-container h2 {
  color: #007bff;
  margin-bottom: 24px;
  font-size: 2rem;
  letter-spacing: 1px;
}
.contacto-container form input,
.contacto-container form textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 18px;
  border-radius: 8px;
  border: 1px solid #b0c4de;
  font-size: 1rem;
  background: #fff;
  transition: border 0.2s;
  box-sizing: border-box;
}
.contacto-container form input:focus,
.contacto-container form textarea:focus {
  border: 1.5px solid #007bff;
  outline: none;
}
.btn-contacto {
  background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
  color: #fff;
  border: none;
  padding: 12px 36px;
  border-radius: 30px;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  box-shadow: 0 2px 12px rgba(0,123,255,0.10);
  transition: background 0.2s, transform 0.2s;
}
.btn-contacto:hover {
  background: #0056b3;
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(0,123,255,0.15);
}
</style>
