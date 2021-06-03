<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const TYPE_BACKEND = 'BACKEND';
    const TYPE_BACKEND_ADMIN = 'BACKEND-ADMIN';
    const TYPE_DASHBOARD = 'DASHBOARD';

    protected $fillable = ['name', 'guard_name'];


    public static function saveRole($request)
    {

        $rol = new self();

        $rol->name = strtolower($request->name);
        $rol->guard_name = 'web';
        $rol->save();

        #Guardamos los permisos asociados al rol
        $menuId = $request->menu_id;
        $new = $request->new;
        $edit = $request->edit;
        $delet = $request->delet;

        foreach ($menuId AS $item) {

            $optionNew = false;
            $optionEdit = false;
            $optionDelet = false;

            $objHasPermission = new HasRoles();
            $objHasPermission->id_menu = $item;

            if ($new) {
                foreach ($new AS $itemNew) {
                    if ($itemNew == $item) {
                        $optionNew = true;
                        break;
                    }
                }
            }

            if ($edit) {
                foreach ($edit AS $itemEdit) {
                    if ($itemEdit == $item) {
                        $optionEdit = true;
                        break;
                    }
                }
            }

            if ($delet) {
                foreach ($delet AS $itemDelet) {
                    if ($itemDelet == $item) {
                        $optionDelet = true;
                        break;
                    }
                }
            }

            $objHasPermission->role_id = $rol->id;
            $objHasPermission->new = $optionNew;
            $objHasPermission->edit = $optionEdit;
            $objHasPermission->delet = $optionDelet;
            $objHasPermission->save();
        }

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($rol, 'saveRole', [
            'users' => $rol
        ]);

        return $rol;
    }

    public static function updateRole($request)
    {
        $obj = new self();
        $rol = $obj->find($request->id);

        $rol->name = strtolower($request->name);
        $rol->save();

        HasRoles::where([['role_id', '=', $request->id]])->delete();

        #Guardamos los permisos asociados al rol
        $menuId = $request->menu_id;
        $new = $request->new;
        $edit = $request->edit;
        $delet = $request->delet;

        foreach ($menuId AS $item) {

            $optionNew = false;
            $optionEdit = false;
            $optionDelet = false;

            $objHasPermission = new HasRoles();
            $objHasPermission->id_menu = $item;

            if ($new) {
                foreach ($new AS $itemNew) {
                    if ($itemNew == $item) {
                        $optionNew = true;
                        break;
                    }
                }
            }

            if ($edit) {
                foreach ($edit AS $itemEdit) {
                    if ($itemEdit == $item) {
                        $optionEdit = true;
                        break;
                    }
                }
            }

            if ($delet) {
                foreach ($delet AS $itemDelet) {
                    if ($itemDelet == $item) {
                        $optionDelet = true;
                        break;
                    }
                }
            }

            $objHasPermission->role_id = $request->id;
            $objHasPermission->new = $optionNew;
            $objHasPermission->edit = $optionEdit;
            $objHasPermission->delet = $optionDelet;
            $objHasPermission->save();
        }

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($rol, 'updateRole', [
            'users' => $rol
        ]);

        return $rol;
    }

    public static function deleteRole($id)
    {
        $obj = new self();

        $rol=$obj->find($id);
        $obj->find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($rol, 'deleteRole', [
            'users' => $rol
        ]);

        return $rol;
    }

}
