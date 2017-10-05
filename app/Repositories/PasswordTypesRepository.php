<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\PasswordType;

class PasswordTypesRepository
{

  public function all()
  {
    return PasswordType::all();
  }

  public function getById($id)
  {
    return PasswordType::find($id);
  }

  public function create($data)
  {
    if (isset($data['icon']) && strlen($data['icon'])) {
      $icon = explode(" ", $data['icon']);
      $data['icon'] = end($icon);
    }

    return PasswordType::create($data);
  }

  public function update($id, $data)
  {
    $passwordType = $this->getById($id);

    if (is_object($passwordType)) {
      if (isset($data['icon']) && strlen($data['icon'])) {
        $icon = explode(" ", $data['icon']);
        $data['icon'] = end($icon);
      }

      return $passwordType->update($data);
    }

    return false;
  }

  public function delete($id)
  {
    $passwordType = $this->getById($id);

    if (is_object($passwordType)) {
      return $passwordType->delete();
    }

    return false;
  }
}
