<section class="features">
  <div class="container">
    <h2>Nuestros Servicios</h2>
    <div class="features-grid">
      <div class="feature-card" onclick="mostrarDetalle('entrenamiento')">
        <h3>Entrenamiento Personalizado</h3>
        <p>Diseñado para ti y tus metas.</p>
      </div>
      <div class="feature-card" onclick="mostrarDetalle('nutricion')">
        <h3>Nutrición Profesional</h3>
        <p>Asesoría en dietas y hábitos saludables.</p>
      </div>
      <div class="feature-card" onclick="mostrarDetalle('seguimiento')">
        <h3>Seguimiento y Motivación</h3>
        <p>Monitoreo de tu progreso y apoyo constante.</p>
      </div>
    </div>
    <div id="detalle-servicio" class="detalle-servicio" style="display:none;">
      <button class="cerrar-detalle" onclick="cerrarDetalle()">✕</button>
      <div id="detalle-contenido"></div>
    </div>
  </div>
</section>

<style>
.features {
  background: #f8f9fa;
  padding: 50px 0 40px 0;
  font-family: Arial, sans-serif;
}
.features .container {
  max-width: 900px;
  margin: 0 auto;
  text-align: center;
}
.features h2 {
  color: #007bff;
  font-size: 2.2rem;
  margin-bottom: 36px;
  letter-spacing: 1px;
}
.features-grid {
  display: flex;
  gap: 28px;
  justify-content: center;
  flex-wrap: wrap;
}
.feature-card {
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 2px 14px rgba(0, 0, 0, 0.15);
  padding: 32px 28px;
  width: 270px;
  cursor: pointer;
  transition: box-shadow 0.2s, transform 0.2s;
  border: 2px solid transparent;
}
.feature-card:hover {
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
  border: 2px solid #007bff;
  transform: translateY(-4px) scale(1.03);
}
.feature-card h3 {
  color: #007bff;
  margin-bottom: 12px;
  font-size: 1.3rem;
}
.feature-card p {
  color: #444;
  font-size: 1rem;
}
.detalle-servicio {
  margin: 32px auto 0 auto;
  max-width: 600px;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.15);
  padding: 32px 28px 24px 28px;
  position: relative;
  animation: fadeIn 0.3s;
}
.detalle-servicio h3,
.detalle-servicio ul,
.detalle-servicio li {
  color: #222 !important;
  font-weight: bold !important;
}
.cerrar-detalle {
  position: absolute;
  top: 16px;
  right: 18px;
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #007bff;
  cursor: pointer;
  font-weight: bold;
}
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.97);}
  to { opacity: 1; transform: scale(1);}
}
</style>

<script>
function mostrarDetalle(servicio) {
  const detalles = {
    entrenamiento: `
      <h3 style="font-weight:bold;">Entrenamiento Personalizado</h3>
      <ul style="text-align:left; font-weight:bold;">
        <li>Rutinas adaptadas a tu nivel y objetivos.</li>
        <li>Entrenadores certificados y seguimiento individual.</li>
        <li>Planificación semanal y ajustes según tu progreso.</li>
        <li>Acceso a entrenamientos presenciales y virtuales.</li>
      </ul>
    `,
    nutricion: `
      <h3 style="font-weight:bold;">Nutrición Profesional</h3>
      <ul style="text-align:left; font-weight:bold;">
        <li>Evaluación nutricional inicial y periódica.</li>
        <li>Planes de alimentación personalizados.</li>
        <li>Consejos para mejorar hábitos y rendimiento.</li>
        <li>Soporte de nutriólogos certificados.</li>
      </ul>
    `,
    seguimiento: `
      <h3 style="font-weight:bold;">Seguimiento y Motivación</h3>
      <ul style="text-align:left; font-weight:bold;">
        <li>Monitoreo de tu progreso corporal y de rendimiento.</li>
        <li>Reportes mensuales y gráficos de avance.</li>
        <li>Recordatorios y mensajes motivacionales.</li>
        <li>Atención personalizada para mantenerte enfocado.</li>
      </ul>
    `
  };
  document.getElementById('detalle-contenido').innerHTML = detalles[servicio];
  document.getElementById('detalle-servicio').style.display = 'block';
}
function cerrarDetalle() {
  document.getElementById('detalle-servicio').style.display = 'none';
}
</script>
