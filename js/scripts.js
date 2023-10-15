/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



    function verifyDelete(id, params) {
        params = params?('&'+params) : '';
        var res = confirm('cancellare record');
        if (res) {
            location.href = 'processForm.php?action=delete&id=' + id+params;

        }
        return false;
    }

