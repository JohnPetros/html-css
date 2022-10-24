<?php

function get_candidates( $data, $roleId, $party)
{

  $title = $data[$roleId]->title;
  $candidates = $data[$roleId]->candidates;
  $candidates = array_filter($candidates, function ($cadidate) use ($party) {
    return $cadidate[$party] == "PEsp";
  });
}

$party_number = substr($candidates[0]->number, 0, 2);

// var_dump($data[$roleId]->candidates);
// var_dump($data[$roleId]->candidates);
// var_dump($candidates);
// foreach($candidates as $cadidate) {
//   foreach($cadidate->$photos as $photo){

//     print_r($photo);
//   }
// }
// foreach($candidates as $cadidate) {
//     print_r($cadidate->photos[0]->url);
// }


?>

<div class="candidates-table">
  <h2><?php echo $party_number ?></h2>
  <div class="party-information">
    <h4>PEsp</h4>
    <h5>partido dos esportes</h5>
    <h3 class="role"><?php echo $title ?></h3>
  </div>
  <div class="candidates">
    <?php
    foreach ($candidates as $candidate) {
      $name = $candidate->name;
      $number = $candidate->number;
      $image = $candidate->images[0]->url;
      $alternates = $candidate->alternates ?? false;
      echo '
          <div class="cadidate">
            <img
              src="' . $image . '"
              alt="Imagem do canditado"
            />
            <h6>' . $name . '</h6>
            <p>' . $number . '</p>
          </div>
          ';
      if ($alternates) {
        foreach ($alternates as $index => $alternate) {
          $alternate_image = $candidate->images[++$index]->url;
          $alternate_name = $alternate;
          $alternate_caption = $candidate->images[$index]->caption;
          echo '
              <div class="cadidate small">
                <img
                  src="' . $alternate_image . '"
                  alt="Imagem do suplente do canditado"
                  class="small"
                />
                <h6>' . $alternate_name . '</h6>
                <p>' . $number . '</p>
                <p>' . $alternate_caption . '</p>
              </div>
              ';
        }
      }
    }


    ?>
    <!-- <div class="candidate">
          <img
            src="https://www.tse.jus.br/hotsites/simulador-de-votacao/image/figuras/135x145/24bpp/9101_atletismo.jpg"
            alt=""
          />
          <h6>Atletismo</h6>
          <p>9101</p>
        </div>
        <div class="candidate">
          <img
            src="https://www.tse.jus.br/hotsites/simulador-de-votacao/image/figuras/135x145/24bpp/9101_atletismo.jpg"
            alt=""
          />
          <h6>Ginástica Artística</h6>
          <p>9102</p>
        </div>
        <div class="candidate">
          <img
            src="https://www.tse.jus.br/hotsites/simulador-de-votacao/image/figuras/135x145/24bpp/9101_atletismo.jpg"
            alt=""
          />
          <h6>Boxe</h6>
          <p>9103</p>
        </div>
        <div class="candidate">
          <img
            src="https://www.tse.jus.br/hotsites/simulador-de-votacao/image/figuras/135x145/24bpp/9101_atletismo.jpg"
            alt=""
          />
          <h6>Halterofilismo</h6>
          <p>9104</p>
        </div> -->
  </div>
</div>
</div>