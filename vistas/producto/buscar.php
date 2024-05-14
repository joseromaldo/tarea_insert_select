<?php include_once '../templates/header.php'; ?>

<h1 class="text-center">Formulario de productos</h1>
<div class="row justify-content-center">
    <form action="/crud_2024/controladores/producto/buscar.php" method="GET" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <label for="prod_nombre">Nombre del producto</label>
                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="prod_precio">Precio del producto</label>
                <input type="number" name="prod_precio" id="prod_precio" min="0" step="0.01" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-info w-100"><i class="bi bi-search me-2"></i>Buscar</button>
            </div>
        </div>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>


   