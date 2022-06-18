# SETUP

## MIGRATION PLAN ON VERSION CONTROL

<!-- ### v0.1.11 -->
<!-- ### v0.1.10 -->
<!-- ### v0.1.9 -->
### v0.1.8

Step 1: Migrate the Unexciting table and seed the pre-installed data for Package.

```bat
   php artisan migrate:status
   php artisan migrate
   php artisan db:seed --class=MapPackageOfferSeeder
   ```

#### ********************* END of v0.1.8 *****************************

### v0.1.7

Step 1: Delete below Tables in database and remove them from migration if exist.

> `appointment_disbursement`</br>`transactions`</br>`payments`

<!-- ### Change Field In DB direct -->

Step 2: Change Datatype of Feedback Table To `bigint` from `int`

Step 3: Rename migrations file From
> `'2022_04_19_135832_appointment_disbursement_table'` To `'2022_04_19_135832_create_appointment_disbursements_table'` </br></br> And Remove </br>`2022_01_09_051752_create_transactions_table`

Step 4: make a model called AppointmentDisbursement

```bat
php artisan make:model Financials/AppointmentDisbursement
```

Step 5: if you're installing this project for the first time you can migrate with seed and escape this step in [README](https://github.com/axetrixhub/ngata_homes/blob/f3922352eb7368637f712d540f67af100c492edf/README.md). Or you can migrate to only affect the changes.

```bat
php artisan migrate
```

OR

```bat
php artisan migrate:fresh --seed
```

#### ********************* END of v0.1.7 *****************************

### v0.1.6

- First delete below Tables in database
  - appointment_payments,
  - rents
  - AddColumnIdentifierToAppointmentsTable

- Remove deleted tables in migration table history  run the command bellow

   ```bat
    php artisan migrate
   ```

Above Command will migrate the following Models

> `appointment_payments` , `rents`, `links`,

and then modify some column (add & drop) in different Models
> `companies`, `gataTarifs`,

- seed new seeders

> `common charges` , `A Payment Services` , `Ngata Tarifs for commisions` , `PackageRoleSeeder`

   1. common charges

      ```bat
      php artisan db:seed --class=AddCommonChargesSeeder
      php artisan db:seed --class=PaymentServicesSeeder
      php artisan db:seed --class=NgataTarifSeeder
      php artisan db:seed --class=PackageRoleSeeder
      ```

#### ********************* END of v0.1.6 *****************************
