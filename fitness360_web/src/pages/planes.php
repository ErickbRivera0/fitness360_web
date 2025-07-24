
<style>
.selected-plan {
  border: 2px solid #007bff !important;
  background: #e6f0ff !important;
}
</style>

<section>
  <div class="container">
    <h2>Elige tu plan</h2>
    <table class="features-table" id="tabla-planes">
      <th></th>
        <th class="plan plan-highlight" data-plan="basico">
          <img src="https://img.freepik.com/premium-vector/editable-ic…entation-website-mobile-app_9028-17393.jpg" 
          alt="Pesas Rusas Icono" style="width:40px;height:40px;"><br>
          Plan Básico
        </th>
        <th class="plan" data-plan="premium">
          <img src="https://img.freepik.com/premium-vector/dumbbell-ic…ign-template-simple-clean_1309366-2879.jpg" 
          alt="Pesas Rusas Icono" style="width:40px;height:40px;"><br>
          Plan Premium
        </th>
        <th class="plan" data-plan="platinum">
          <img src="	https://img.freepik.com/premium-vector/dumbbells-i…n-isolated-white-background_96318-66879.jpg" 
          alt="Pesas Rusas Icono" style="width:40px;height:40px;"><br>
          Plan Platinum
        </th>
      </tr>
      <tr>
        <td>Acceso al gimnasio</td>
        <td data-plan="basico" class="plan-highlight"><span class="check">&#10003;</span></td>
        <td data-plan="premium"><span class="check">&#10003;</span></td>
        <td data-plan="platinum"><span class="check">&#10003;</span></td>
      </tr>
      <tr>
        <td>Rutinas generales</td>
        <td data-plan="basico" class="plan-highlight"><span class="check">&#10003;</span></td>
        <td data-plan="premium"><span class="check">&#10003;</span></td>
        <td data-plan="platinum"><span class="check">&#10003;</span></td>
      </tr>
      <tr>
        <td>Entrenador personal</td>
        <td data-plan="basico" class="plan-highlight"><span class="cross">&#10007;</span></td>
        <td data-plan="premium"><span class="check">&#10003;</span></td>
        <td data-plan="platinum"><span class="check">&#10003;</span></td>
      </tr>
      <tr>
        <td>Dieta personalizada</td>
        <td data-plan="basico" class="plan-highlight"><span class="cross">&#10007;</span></td>
        <td data-plan="premium"><span class="cross">&#10007;</span></td>
        <td data-plan="platinum"><span class="check">&#10003;</span></td>
      </tr>
      <tr>
        <td>App móvil</td>
        <td data-plan="basico" class="plan-highlight"><span class="cross">&#10007;</span></td>
        <td data-plan="premium"><span class="cross">&#10007;</span></td>
        <td data-plan="platinum"><span class="check">&#10003;</span></td>
      </tr>
      <tr>
        <td>Precio</td>
        <td data-plan="basico" class="plan-highlight"><strong>L. 650.00</strong>/mes</td>
        <td data-plan="premium"><strong>L. 750.00</strong>/mes</td>
        <td data-plan="platinum"><strong>L. 850.00</strong>/mes</td>
      </tr>
    </table>
    <div style="text-align:center; margin-top:30px;">
      <button id="btn-inscribirse" class="btn btn-primary" disabled>Seleccionar este plan</button>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  let selectedPlan = null;
  const table = document.getElementById('tabla-planes');
  const btn = document.getElementById('btn-inscribirse');

  table.querySelectorAll('th[data-plan]').forEach((th) => {
    th.addEventListener('click', function() {
      
      table.querySelectorAll('th[data-plan], td[data-plan]').forEach(cell => {
        cell.classList.remove('selected-plan');
      });
     
      const plan = th.getAttribute('data-plan');
      selectedPlan = plan;
      btn.disabled = false;
      
      table.querySelectorAll('th[data-plan="'+plan+'"], td[data-plan="'+plan+'"]').forEach(cell => {
        cell.classList.add('selected-plan');
      });
    });
  });

  btn.addEventListener('click', function() {
    if(selectedPlan) {

      window.location.href = 'index.php?page=pagos&plan=' + selectedPlan + '&goto=matricula';
    }
  });
});
</script>