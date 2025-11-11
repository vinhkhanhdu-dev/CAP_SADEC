/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:49:15
 * File: Category.js
 */

import Resource from '../../api/resource';
import request from '../../utils/request';

export function getCategory(param) {    
    return request({
      url: '/api/admin/categorys',
      method: 'get',
      params:param
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}

