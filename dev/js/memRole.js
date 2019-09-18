function memRole(memNo){
    $.ajax({    
        url: `memRole.php?action=loadMem`,
        data: {
            memNo:memNo
        },
        type: 'GET',
        success: function(rows){
            let mems = JSON.parse(rows);
            console.log(mems);
            let htmlStr = '';
            htmlStr += `<div class="memberRole"><div class="roleBody">`;
            htmlStr += `<img src="${mems[0][0].set_body_src}" alt="我來組成身體" class="memRoleBody">`;
            htmlStr += `<div class="rolePart"><img src="${mems[0][0].set_part_src}" alt="我來組成不變色的部分" class="memRolePart"></div>`;
            htmlStr += `<div class="roleAccessory"><img src="${mems[3][0].equip_src}" alt="我來組成飾品"></div>`;
            htmlStr += `<div class="roleLeftHand">
            <img src="${mems[0][0].set_lefthand_src}" alt="我來組成左手" class="memRoleLeftHand"></div>`;
            htmlStr += `<div class="roleRightHand"><img src="${mems[0][0].set_righthand_src}" alt="我來組成右手" class="memRoleRightHand"><div class="weaponEquip"><img src="${mems[1][0].equip_src}" alt="我來組成武器"></div></div>`;
            htmlStr += `<div class="roleVehicle"><img src="${mems[4][0].level_vehicle_src}" alt="我來組成載具"></div>`;
            htmlStr += `</div>
            </div>`;
            return htmlStr;
        }
    });
}