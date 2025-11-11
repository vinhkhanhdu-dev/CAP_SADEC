import request from '../../utils/request';

/**
 * login
 * @param form
 * @returns {AxiosPromise}
 * @author tanmnt
 */
export function login(form) {
  return request({
    url: '/api/auth/login',
    method: 'post',
    data: form,
  });
}

/**
 * user info
 * @returns {AxiosPromise}
 * @author tanmnt
 */
export function userInfo() {
  return request({
    url: '/api/auth/me',
    method: 'get',
  });
}

/**
 * logout
 * @returns {AxiosPromise}
 * @author tanmnt
 */
export function logout() {
  return request({
    url: '/v1/logout',
    method: 'get',
  });
}

export function sendPasswordResetLink(form) {
  return request({
    url: '/v1/forgot-password',
    method: 'post',
    data: form,
  });
}

export function callResetPassword(form) {
  return request({
    url: '/v1/reset-password',
    method: 'post',
    data: form,
  });
}
