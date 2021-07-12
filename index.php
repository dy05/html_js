<?php
    $error = null;
    if (! empty($_POST)) {
        var_dump($_POST);
        die();
    }
    $regions = [
        [
            'id' => 1,
            'name' => 'Extreme-Nord',
            'departments' => ['Diamaré', 'Logone-et-Chari', 'Mayo-Danay', 'Mayo-Kani', 'Mayo-Sava', 'Mayo-Tsanaga']
        ], [
            'id' => 2,
            'name' => 'Nord',
            'departments' => ['Bénoué', 'Faro', 'Mayo-Louti', 'Mayo-Rey']
        ], [
            'id' => 3,
            'name' => 'Adamaoua',
            'departments' => ['Djérem', 'Faro-et-Déo', 'Mayo-Banyo', 'Mbéré', 'Vina']
        ], [
            'id' => 4,
            'name' => 'Est',
            'departments' => ['Boumba-et-Ngoko', 'Haut-Nyong', 'Kadey', 'Lom-et-Djérem']
        ], [
            'id' => 5,
            'name' => 'Centre',
            'departments' => ['Haute-Sanaga', 'Lekié', 'Mbam-et-Inoubou', 'Mbam-et-kim', 'Méfou-et-Afamba', 'Méfou-et-Akono', 'Mfoundi', 'Nyong-et-Kellé', 'Nyong-et-Mfoumou', 'Nyong-et-So\'o']
        ], [
            'id' => 6,
            'name' => 'Sud',
            'departments' => ['Dja-et-Lobo', 'Mvila', 'Océan', 'Vallée-du-Ntem']
        ], [
            'id' => 7,
            'name' => 'Littoral',
            'departments' => ['Moungo', 'Nkam', 'Sanaga-Maritime', 'Wouri']
        ], [
            'id' => 8,
            'name' => 'Ouest',
            'departments' => ['Bamboutos', 'Haut-Nkam', 'Hauts-plateaux', 'Koung-Khi', 'Menoua', 'Mifi', 'Ndé', 'Noun']
        ], [
            'id' => 9,
            'name' => 'Nord-Ouest',
            'departments' => ['Boyo', 'Bui', 'Donga-Mantung', 'Menchum', 'mezam', 'momo', 'Ngo-Ketunjia']
        ], [
            'id' => 10,
            'name' => 'Sud-Ouest',
            'departments' => ['Fako', 'Koupé-Manengouba', 'Lebialem', 'Manyu', 'Meme', 'Ndian']
        ],
    ];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Javascript Select</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-body pb-2">
            <form action="" method="post">
                <div class="form-group">
                    <label for="region">Choose your region</label>
                    <select name="region" id="region" class="form-control">
                        <option value="" selected disabled>Choose a region</option>
                        <?php foreach ($regions as $region): ?>
                            <option value="<?= $region['id']; ?>" data-content='<?= htmlspecialchars(json_encode($region['departments']), ENT_QUOTES, 'UTF-8'); ?>'>
                                <?= $region['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="department">Choose the department (Choose region before)</label>
                    <select name="department" id="department" class="form-control" required>
                        <option value="" selected disabled>Choose a department</option>
                    </select>
                </div>
                <div class="d-flex mt-3">
                    <button type="submit" class="ms-auto btn btn-primary">Validate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
  // Permet d'ecouter quand la page charge
  window.addEventListener('load', () => {
    let $regionSelect = document.getElementById('region');
    let $departmentSelect = document.getElementById('department');
    let $newDepartment = null;
    let $selectedRegion = null;
    if ($regionSelect && $departmentSelect) {
      $regionSelect.addEventListener('change', (e) => {
        $selectedRegion = e.target.querySelectorAll('option')
          ? e.target.querySelectorAll('option')[e.currentTarget.selectedIndex]
          : null;
        reloadDepartments();
      })
    }

    if ($regionSelect && $regionSelect.selectedIndex) {
      $selectedRegion = $regionSelect.querySelectorAll('option')
        ? $regionSelect.querySelectorAll('option')[$regionSelect.selectedIndex]
        : null;
      reloadDepartments();
    }

    function reloadDepartments() {
      let opt = '<option value="" selected disabled>Choose a department</option>';
      if ($selectedRegion) {
        $newDepartment = JSON.parse($selectedRegion.getAttribute('data-content'));
        if ($newDepartment.length) {
          $departmentSelect.innerHTML = opt;
          for (let i = 0; i < $newDepartment.length; i++){
            opt = document.createElement('option');
            opt.value = $newDepartment[i];
            opt.innerHTML = $newDepartment[i];
            $departmentSelect.appendChild(opt);
          }
        }
      }
    }
  })
</script>

</body>
</html>
