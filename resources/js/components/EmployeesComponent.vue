<template>
  <div class="card">
    <div class="card-header">Employees</div>

    <div class="card-body">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Filter employees using full name or partial name"
          v-model="search_key"
        >
      </div>

      <table class="table table-striped table-light">
        <thead>
          <tr>
            <th scope="col">ID Number</th>
            <th scope="col">Full Name</th>
            <th scope="col">Campaign</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employee in filtered_employees" :key="employee.id">
            <td>{{ employee.e_id }}</td>
            <td>{{ employee.full_name }}</td>
            <td>{{ employee.campaign }}</td>
            <td>
              <button class="btn btn-sm btn-success" disabled v-if="employee.status">Active</button>
              <button class="btn btn-sm btn-danger" disabled v-else>Inactive</button>
            </td>
            <td>
              <button class="btn btn-sm btn-primary" @click="editEmployee(employee.id)">Edit</button>
              <button
                class="btn btn-sm btn-danger"
                @click="deactivateEmployee(employee.id)"
                v-if="employee.status"
              >Deactivate</button>
              <button
                class="btn btn-sm btn-success"
                @click="activateEmployee(employee.id)"
                v-else
              >Activate</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employees: [],
      search_key: ""
    };
  },
  created() {
    axios
      .get("/get/employees")
      .then(result => {
        console.log("fetched employees", result.data);
        this.employees = result.data.data;
      })
      .catch(err => console.log(err.response.data));
  },
  methods: {
    editEmployee(id) {
      window.location.href = `/employee/${id}/edit`;
    },
    activateEmployee(id) {
      axios
        .get("/employee/" + id + "/activate")
        .then(response => {
          console.log(response);
          const updatedEmployees = [...this.employees];
          const index = this.employees.findIndex(
            employee => employee.id === id
          );
          updatedEmployees[index].status = 1;
          this.employees = [...updatedEmployees];
        })
        .catch(err => console.log(err));
    },
    deactivateEmployee(id) {
      axios
        .get("/employee/" + id + "/deactivate")
        .then(response => {
          console.log(response);
          const updatedEmployees = [...this.employees];
          const index = this.employees.findIndex(
            employee => employee.id === id
          );
          updatedEmployees[index].status = 0;
          this.employees = [...updatedEmployees];
        })
        .catch(err => console.log(err));
    }
  },
  computed: {
    filtered_employees() {
      return this.employees.filter(employee => {
        return employee.full_name
          .toLowerCase()
          .includes(this.search_key.toLowerCase());
      });
    }
  }
};
</script>
