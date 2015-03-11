<?php

/**
 *
 * ====================================create base farming group and user ==============================================
 * create role farming_group;
 * grant select, insert, update, delete on client to farming_group;
 * create role farming_group_user with login in role farming_group password 'farming_group_user';
 *
 * ===================================== drop base group ===============================================================
 * revoke select,insert,update,delete on client from farming_group; #revoke privileges for dropping group `farming_group`
 * drop role farming_group;
 *
 * =====================================================================================================================
 */

namespace Admin\ClientBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AdminClientBundle extends Bundle
{
}
