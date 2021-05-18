import request from '../utils/request';

export function deleteEmployee(employeeId) {
  return request({
    url: `/employees/${employeeId}`,
    method: 'delete',
  });
}

export function getEmployee(employeeId) {
  return request({
    url: `/employees/${employeeId}`,
    method: 'get',
  });
}

export function getEmployees() {
  return request({
    url: '/employees',
    method: 'get',
  });
}

export function postEmployee(data) {
  return request({
    url: '/employees',
    method: 'post',
    data,
  });
}

export function putEmployee(employeeId, data) {
  return request({
    url: `/employees/${employeeId}`,
    method: 'put',
    data,
  });
}
