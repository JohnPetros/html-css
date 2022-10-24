<?php
function get_party_fullname($party)
{
    switch ($party) {
        case "PEsp":
            return "PARTIDO DOS ESPORTES";
            break;
        case "PMus":
            return "PARTIDO DOS RITMOS MUSICAIS";
            break;
        case "PProf":
            return "PARTIDO DAS PROFISSÕES";
            break;
        case "PFest":
            return "PARTIDO DAS FESTAS POPULARES";
            break;
        case "PFolc":
            return "PARTIDO DO FOLCLORE";
            break;
        default:
            return;
    }
}

function get_candidates($data, $roleId, $party)
{

    $title = $data[$roleId]->title;
    $candidates = $data[$roleId]->candidates;
    $candidates = array_values(array_filter($candidates, function ($cadidate) use ($party) {
        return $cadidate->party == $party;
    }));
    $party_number = substr($candidates[0]->number, 0, 2);

    echo '<h2>' . $party_number . '</h2>
    <div class="party-information">
        <h4>' . $party . '</h4>
        <h5>' . get_party_fullname($party) . '</h5>
        <h3 class="role">' . $title . '</h3>
    </div>
    <div class="candidates">';

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
        <h6 class="name">' . $name . '</h6>
        <p>' . $number . '</p>
      </div>
      ';
    }
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
                <h6 class="name">' . $alternate_name . '</h6>
                <p>' . $alternate_caption . '</p>
            </div>
            ';
        }
    }
    echo '</div>
    </div>';
}
