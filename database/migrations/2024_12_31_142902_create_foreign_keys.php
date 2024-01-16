<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        /* Schema::table('Users', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Stores', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Typhardwares', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Invtytypes', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Manufacturers', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Hardwares', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Hardwares', function (Blueprint $table) {
            $table->foreign('TphdwId')->references('id')->on('Typhardwares')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Hardwares', function (Blueprint $table) {
            $table->foreign('ManfId')->references('id')->on('Manufacturers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('Inventories', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->foreign('HdwId')->references('id')->on('Hardwares')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->foreign('StockIN')->references('StockId')->on('Stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->foreign('InvTypeId')->references('TypeId')->on('Invtytypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->foreign('HdwId')->references('id')->on('Hardwares')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->foreign('InvTypeId')->references('TypeId')->on('Invtytypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->foreign('StockIN')->references('StockId')->on('Stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->foreign('StockOUT')->references('StockId')->on('Stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('Savings', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Savings', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Savingstrans', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Savingstrans', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Savings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Savingstrans', function (Blueprint $table) {
            $table->foreign('savingid')->references('id')->on('Savings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxordersts', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('boxorderstypes', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdrawtypes', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('statusid')->references('id')->on('boxordersts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('orderTyp')->references('id')->on('boxorderstypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('installmentPeriod')->references('id')->on('Installmentperiods')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('sponsor')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('empacc')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('empmgr')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('aprovalacc')->references('id')->on('approvals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('aprovalmgr')->references('id')->on('approvals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->foreign('aprovalsponsor')->references('id')->on('approvals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Employeefinancials', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Employeefinancials', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('witype')->references('id')->on('Withdrawtypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('empacc')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('empmgr')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('aprovalacct')->references('id')->on('approvals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->foreign('aprovalmgr')->references('id')->on('approvals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->foreign('boxorders_id')->references('id')->on('Boxorders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->foreign('sprno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('boanalyse_guarantee_pivots', function (Blueprint $table) {
            $table->foreign('analyse_id')->references('id')->on('Boxordersanalyses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('boanalyse_guarantee_pivots', function (Blueprint $table) {
            $table->foreign('guarantee_id')->references('id')->on('boxorderguarantees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Approvals', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxbalances', function (Blueprint $table) {
            $table->foreign('empno')->references('empno')->on('Employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxbalances', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxbalancestrans', function (Blueprint $table) {
            $table->foreign('balanceid')->references('id')->on('Boxbalances')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('Boxbalancestrans', function (Blueprint $table) {
            $table->foreign('userEntry')->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });*/






    }

    public function down()
    {
        /* Schema::table('Users', function (Blueprint $table) {
            $table->dropForeign('Users_empno_foreign');
        });
        Schema::table('Employeefinancials', function (Blueprint $table) {
            $table->dropForeign('Employeefinancials_userEntry_foreign');
        });
        Schema::table('Employeefinancials', function (Blueprint $table) {
            $table->dropForeign('Employeefinancials_empno_foreign');
        });
        Schema::table('Typhardwares', function (Blueprint $table) {
            $table->dropForeign('Typhardwares_userEntry_foreign');
        });
        Schema::table('Invtytypes', function (Blueprint $table) {
            $table->dropForeign('Invtytypes_userEntry_foreign');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->dropForeign('Invtytracks_userEntry_foreign');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->dropForeign('Invtytracks_HdwId_foreign');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->dropForeign('Invtytracks_InvTypeId_foreign');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->dropForeign('Invtytracks_StockIN_foreign');
        });
        Schema::table('Invtytracks', function (Blueprint $table) {
            $table->dropForeign('Invtytracks_StockOUT_foreign');
        });
        Schema::table('Savings', function (Blueprint $table) {
            $table->dropForeign('Savings_userEntry_foreign');
        });
        Schema::table('Savings', function (Blueprint $table) {
            $table->dropForeign('Savings_empno_foreign');
        });
        Schema::table('Savingstrans', function (Blueprint $table) {
            $table->dropForeign('Savingstrans_userEntry_foreign');
        });
        Schema::table('Savingstrans', function (Blueprint $table) {
            $table->dropForeign('Savingstrans_empno_foreign');
        });
        Schema::table('Savingstrans', function (Blueprint $table) {
            $table->dropForeign('Savingstrans_savingid_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_userEntry_foreign');
        });
        Schema::table('boxorderstypes', function (Blueprint $table) {
            $table->dropForeign('boxorderstypes_userEntry_foreign');
        });
        Schema::table('Boxordersts', function (Blueprint $table) {
            $table->dropForeign('Boxordersts_userEntry_foreign');
        });
        Schema::table('Hardwares', function (Blueprint $table) {
            $table->dropForeign('Hardwares_userEntry_foreign');
        });
        Schema::table('Hardwares', function (Blueprint $table) {
            $table->dropForeign('Hardwares_TphdwId_foreign');
        });
        Schema::table('Hardwares', function (Blueprint $table) {
            $table->dropForeign('Hardwares_ManfId_foreign');
        });
        Schema::table('Stores', function (Blueprint $table) {
            $table->dropForeign('Stores_userEntry_foreign');
        });
        Schema::table('Manufacturers', function (Blueprint $table) {
            $table->dropForeign('Manufacturers_userEntry_foreign');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->dropForeign('Inventories_userEntry_foreign');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->dropForeign('Inventories_HdwId_foreign');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->dropForeign('Inventories_StockIN_foreign');
        });
        Schema::table('Inventories', function (Blueprint $table) {
            $table->dropForeign('Inventories_InvTypeId_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_statusid_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_orderTyp_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_empno_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_sponsor_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_installmentPeriod_foreign');
        });
        Schema::table('Withdrawtypes', function (Blueprint $table) {
            $table->dropForeign('Withdrawtypes_userEntry_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_userEntry_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_witype_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_empno_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_aprovalacct_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_aprovalhed_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_empmgr_foreign');
        });
        Schema::table('Withdraws', function (Blueprint $table) {
            $table->dropForeign('Withdraws_aprovalmgr_foreign');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->dropForeign('Boxordersanalyses_boxorders_id_foreign');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->dropForeign('Boxordersanalyses_empno_foreign');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->dropForeign('Boxordersanalyses_sprno_foreign');
        });
        Schema::table('Boxordersanalyses', function (Blueprint $table) {
            $table->dropForeign('Boxordersanalyses_userEntry_foreign');
        });
        Schema::table('boanalyse_guarantee_pivots', function (Blueprint $table) {
            $table->dropForeign('boanalyse_guarantee_pivots_analyse_id_foreign');
        });
        Schema::table('boanalyse_guarantee_pivots', function (Blueprint $table) {
            $table->dropForeign('boanalyse_guarantee_pivots_guarantee_id_foreign');
        });
        Schema::table('Approvals', function (Blueprint $table) {
            $table->dropForeign('Approvals_userEntry_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_empacc_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_empmgr_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_aprovalacc_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_aprovalmgr_foreign');
        });
        Schema::table('Boxorders', function (Blueprint $table) {
            $table->dropForeign('Boxorders_aprovalsponsor_foreign');
        });
        Schema::table('Boxbalances', function (Blueprint $table) {
            $table->dropForeign('Boxbalances_empno_foreign');
        });
        Schema::table('Boxbalances', function (Blueprint $table) {
            $table->dropForeign('Boxbalances_userEntry_foreign');
        });

        Schema::table('Boxbalancestrans', function (Blueprint $table) {
            $table->dropForeign('Boxbalancestrans_balanceid_foreign');
        });
        Schema::table('Boxbalancestrans', function (Blueprint $table) {
            $table->dropForeign('Boxbalancestrans_userEntry_foreign');
        }); */
    }
}
