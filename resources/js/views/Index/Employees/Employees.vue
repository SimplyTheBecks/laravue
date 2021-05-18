<template>
    <v-card>
        <v-card-text>
            <v-data-table
                class="elevation-1"
                :headers="headers"
                :items="employees"
                sort-by="surname"
            >
                <template
                    v-slot:top
                >
                    <v-toolbar
                        flat
                    >
                        <v-spacer></v-spacer>
                        <v-dialog
                            v-model="dialog"
                            max-width="500px"
                        >
                            <template
                                v-slot:activator="{ on, attrs }"
                            >
                                <v-btn
                                    v-bind="attrs"
                                    v-on="on"
                                    class="mb-2"
                                    color="red"
                                    dark
                                >
                                    Создать сотрудника
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span
                                        class="headline"
                                    >
                                        {{ formTitle }}
                                    </span>
                                </v-card-title>
                                <v-card-text>
                                    <v-text-field
                                        v-model="editedEmployee.surname"
                                        color="red"
                                        :error-messages="editedEmployeeErrors.surname"
                                        label="Фамилия"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="editedEmployee.name"
                                        color="red"
                                        :error-messages="editedEmployeeErrors.name"
                                        label="Имя"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="editedEmployee.patronymic"
                                        color="red"
                                        :error-messages="editedEmployeeErrors.patronymic"
                                        label="Отчество"
                                    ></v-text-field>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="red darken-1"
                                        :loading="saveLoading"
                                        text
                                        @click="save"
                                    >
                                        Сохранить
                                    </v-btn>
                                    <v-btn
                                        color="red darken-1"
                                        text
                                        @click="close"
                                    >
                                        Закрыть
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        <v-dialog
                            v-model="dialogDelete"
                            max-width="500px"
                        >
                            <v-card>
                                <v-card-title
                                    class="headline"
                                >
                                    Вы уверены что хотите удалить данного сотрудника?
                                </v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="red darken-1"
                                        :loading="deleteLoading"
                                        text
                                        @click="deleteEmployeeConfirm"
                                    >
                                        Да
                                    </v-btn>
                                    <v-btn
                                        color="red darken-1"
                                        text
                                        @click="closeDelete"
                                    >
                                        Нет
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template
                    v-slot:item.actions="{ item }"
                >
                    <v-icon
                        class="mr-2"
                        small
                        title="Редактировать сотрудника"
                        @click="editEmployee(item)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        small
                        title="Удалить сотрудника"
                        @click="deleteEmployee(item)"
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-card-text>
        <v-overlay
            :value="overlay"
        >
            <v-progress-circular
                color="red"
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>
    </v-card>
</template>

<script>
import {
  deleteEmployee,
  getEmployees,
  postEmployee,
  putEmployee,
} from '../../../api/employees';

export default {
  name: 'Employees',
  data() {
    return {
      defaultEmployee: {
        id: null,
        surname: '',
        name: '',
        patronymic: '',
      },
      defaultEmployeeErrors: {
        surname: '',
        name: '',
        patronymic: '',
      },
      deleteLoading: false,
      dialog: false,
      dialogDelete: false,
      editedEmployee: {
        id: null,
        surname: '',
        name: '',
        patronymic: '',
      },
      editedEmployeeErrors: {
        surname: '',
        name: '',
        patronymic: '',
      },
      editedEmployeeIndex: -1,
      employees: [],
      headers: [
        {
          text: 'Фамилия',
          value: 'surname',
        },
        {
          text: 'Имя',
          value: 'name',
        },
        {
          text: 'Отчество',
          value: 'patronymic',
        },
        {
          text: '',
          value: 'actions',
          sortable: false,
          width: '5%',
        },
      ],
      overlay: false,
      saveLoading: false,
    };
  },
  computed: {
    formTitle() {
      return this.editedEmployeeIndex === -1
        ? 'Создание сотрудника'
        : 'Редактирование сотрудника';
    },
  },
  methods: {
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.setDefaultEmployeeValues();
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.setDefaultEmployeeValues();
      });
    },
    deleteEmployee(item) {
      this.editedEmployeeIndex = this.employees.indexOf(item);
      this.editedEmployee = { ...item };
      this.dialogDelete = true;
    },
    deleteEmployeeConfirm() {
      this.deleteLoading = true;
      deleteEmployee(this.editedEmployee.id).then(() => {
        this.employees.splice(this.editedEmployeeIndex, 1);
        this.deleteLoading = false;
        this.closeDelete();
      });
    },
    editEmployee(item) {
      this.editedEmployeeIndex = this.employees.indexOf(item);
      this.editedEmployee = { ...item };
      this.dialog = true;
    },
    getEmployees() {
      this.overlay = true;
      getEmployees().then((response) => {
        this.employees = response.data;
        this.overlay = false;
      });
    },
    save() {
      this.saveLoading = true;
      const data = {
        surname: this.editedEmployee.surname,
        name: this.editedEmployee.name,
        patronymic: this.editedEmployee.patronymic,
      };
      if (this.editedEmployeeIndex > -1) {
        putEmployee(this.editedEmployee.id, data).then(() => {
          Object.assign(
            this.employees[this.editedEmployeeIndex],
            this.editedEmployee,
          );
          this.close();
        }).catch((error) => {
          if (error.response.status === 422) {
            this.validationProcessing(error.response);
          } else {
            console.log(error.response);
          }
        }).finally(() => {
          this.saveLoading = false;
        });
      } else {
        postEmployee(data).then(() => {
          this.employees.push(this.editedEmployee);
          this.close();
        }).catch((error) => {
          if (error.response.status === 422) {
            this.validationProcessing(error.response);
          } else {
            console.log(error.response);
          }
        }).finally(() => {
          this.saveLoading = false;
        });
      }
    },
    setDefaultEmployeeValues() {
      this.editedEmployee = { ...this.defaultEmployee };
      this.editedEmployeeErrors = { ...this.defaultEmployeeErrors };
      this.editedEmployeeIndex = -1;
    },
    validationProcessing(response) {
      const fields = Object.keys(response.data);
      const values = Object.values(response.data);
      values.forEach((value, i) => {
        this.editedEmployeeErrors[fields[i]] = value;
      });
    },
  },
  mounted() {
    this.getEmployees();
  },
  watch: {
    dialog(val) {
      // eslint-disable-next-line no-unused-expressions
      val || this.close();
    },
    dialogDelete(val) {
      // eslint-disable-next-line no-unused-expressions
      val || this.closeDelete();
    },
  },
};
</script>

<style
    scoped
>

</style>
