<section class="hero">
  <div class="container">
    <h2>Transforma tu cuerpo y mente</h2>
    <p>Entrenamiento personalizado, seguimiento y motivación constante.</p>
    <a href="index.php?page=planes" class="btn">Ver planes</a>
  </div>
</section>

<style>
.hero {
  background: linear-gradient(120deg, #007bff 60%, #00c6ff 100%);
  color: #fff;
  padding: 80px 0 60px 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.hero::before {
  content: "";
  position: absolute;
  top: -60px;
  left: -60px;
  width: 200px;
  height: 200px;
  background: rgba(255,255,255,0.08);
  border-radius: 50%;
  z-index: 1;
}
.hero .container {
  position: relative;
  z-index: 2;
  max-width: 600px;
  margin: 0 auto;
}
.hero h2 {
  font-size: 2.8rem;
  font-weight: bold;
  margin-bottom: 18px;
  letter-spacing: 1px;
  text-shadow: 0 2px 12px rgba(0,0,0,0.12);
}
.hero p {
  font-size: 1.3rem;
  margin-bottom: 32px;
  color: #e0e0e0;
  text-shadow: 0 1px 8px rgba(0,0,0,0.10);
}
.hero .btn {
  background: #fff;
  color: #007bff;
  padding: 14px 38px;
  border-radius: 30px;
  font-size: 1.2rem;
  font-weight: bold;
  text-decoration: none;
  box-shadow: 0 4px 18px rgba(0,0,0,0.10);
  transition: background 0.2s, color 0.2s, transform 0.2s;
  border: none;
  display: inline-block;
}
.hero .btn:hover {
  background: #007bff;
  color: #fff;
  transform: scale(1.05);
}
</style>
