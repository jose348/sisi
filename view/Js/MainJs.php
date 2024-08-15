<script src = "../../public/lib/jquery/jquery.js"></script>
<script src = "../../public/lib/popper.js/popper.js"></script> 
<script src = "../../public/lib/bootstrap/bootstrap.js"></script> 
<script src = "../../public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src = "../../public/lib/moment/moment.js"></script> 
<script src = "../../public/lib/jquery-ui/jquery-ui.js"></script> 
<script src = "../../public/lib/jquery-switchbutton/jquery.switchButton.js"></script> 
<script src = "../../public/lib/peity/jquery.peity.js"></script>
<script src = "../../public/js/bracket.js"></script>

<!-- LIBRERIAS DADAS POR EL PROGRAMADOR -->
<!-- LIBRERIAS DADAS POR EL PROGRAMADOR -->
<script src = "../../public/lib/datatables/jquery.dataTables.js"></script>
<script src = "../../public/lib/datatables-responsive/dataTables.responsive.js"></script>


<!-- CARPERTA DADA public/datatables POR EL PROGRAMADOR -->

<script src = "../../public/datatables/dataTables.buttons.min.js"></script>
<script src = "../../public/datatables/buttons.html5.min.js"></script>
<script src = "../../public/datatables/buttons.colVis.min.js"></script>
<script src = "../../public/datatables/jszip.min.js"></script>

<script src="../../public/lib/select2/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function () {
        // Funci n para obtener la base del path del sitio para construir URLs absolutas desde relativas.
        function getBasePath() {

            return '/sisi/view';
        }

        // Funci n para normalizar la URL de la p gina actual y los enlaces del men .
        function normalizePath(path) {
            var basePath = getBasePath();
            // Eliminar cualquier referencia relativa '../../../'
            var newPath = path.replace(/(\.\.\/)+/g, '');
            // Asegurarse de que la ruta inicie correctamente con la base del path del sitio
            if (!newPath.startsWith('/')) {
                newPath = '/' + newPath;
            }
            // Concatenar con base path si no inicia con este
            if (!newPath.startsWith(basePath)) {
                newPath = basePath + newPath;
                
            }
            // Eliminar la barra final, si existe
            if (newPath.endsWith('/') && newPath.length > 1) {
                newPath = newPath.substring(0, newPath.length - 1);
                
            }
            
            return newPath;
            
        }

        // Obtener la URL actual normalizada.
        var currentUrl = normalizePath(window.location.pathname);

        // Iterar sobre cada enlace en el men .
        $('a').each(function () {
            var $this = $(this);
            var linkUrl = normalizePath($this.attr('href'));

            // Comparar si el href del enlace coincide con la URL actual.
            if (currentUrl === linkUrl) {
                $this.addClass('active'); // A ade clase 'active' al enlace correspondiente.
                $this.closest('.br-menu-sub').prev('.br-menu-link').addClass('active'); // Marca el enlace principal si est  dentro de un submen .
                $this.parents('ul.br-menu-sub').show(); // Muestra el submen  si est  dentro de uno.
                $this.parent().addClass('active'); // A ade clase 'active' al  tem del men .
            }
        });
    });
</script>
