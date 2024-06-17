<div class="col-12 bg-body-secondary bg-opacity-25 fixed-bottom color">
Creado por alberto lozano lozano
</div>

<!-- Modal estático para mostrar información -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">INFORMACION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Parcela</th>
                                        <td id="parcela"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Abono</th>
                                        <td id="abono"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Cantidad</th>
                                        <td id="cantidad"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Riego</th>
                                        <td id="riego"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="Hecho" type="button" class="btn btn-primary" data-bs-dismiss="modal">Hecho</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para abrir el modal estático -->
<script>
    function abrirModal(idBoton) {
        // Obtén el botón por su ID
        let boton = document.getElementById(idBoton);
        let parcela = boton.dataset.parcela;
       
        document.getElementById('parcela').innerHTML = parcela;

        let abono = boton.dataset.abono;
        
        document.getElementById('abono').innerHTML = abono;

        let cantidad = boton.dataset.cantidad;
        document.getElementById('cantidad').innerHTML = cantidad;
      

        let riego = boton.dataset.riego;
        document.getElementById('riego').innerHTML = riego;
      
        // Abre el modal
        let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        myModal.show();
    }
</script>

<!-- Modal de alerta -->
<div id="alertModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="alertModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
