<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Estado Proyectos</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="chart-responsive">
            <canvas id="myChart" height="150px"></canvas>
          </div>
          <!-- ./chart-responsive -->
        </div>

      </div>
      <!-- /.row -->
    </div>

  </div>
<script src="{{asset('js/Chart.min.js')}}"></script>

<script>

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
type: 'doughnut',
data: {
labels: ["Perfil", "Aprobados", "En Lista", "Rechazados"],
datasets: [{
    label: '# of Votes',
    data: [12, 19, 3, 5],
    backgroundColor: [
        'rgba(0,192,239, 1)',
        'rgba(0,166,90, 1)',
        'rgba(243,156,18, 1)',
        'rgba(221,75,57, 1)'
        
    ],
    borderColor: [
        'rgba(0,192,239,1)',
        'rgba(0,166,90, 1)',
        'rgba(243,156,18, 1)',
        'rgba(221,75,57, 1)'
    ],
    borderWidth: 1
}]
}
});
</script>
