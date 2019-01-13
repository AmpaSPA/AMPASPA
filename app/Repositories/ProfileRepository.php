<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 19/12/17
 * Time: 13:27
 */

namespace App\Repositories;

use App\Profile;

class ProfileRepository
{
    public function crearprofile($id)
    {
        $profile = new Profile();
        $profile->user_id = $id;
        $profile->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function activarprofile($id)
    {
        $perfil = $this->buscarprofileporid($id);
        $perfil->activo = true;
        $perfil->save();
        return $perfil;
    }

    /**
     * Se busca el registro de perfil del id del socio
     * @param  Integer $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function buscarprofileporid($id)
    {
        return Profile::find($id);
    }
}
