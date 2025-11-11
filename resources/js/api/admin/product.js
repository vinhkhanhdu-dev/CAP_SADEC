
import Resource from '../../api/resource';
import request from '../../utils/request';

export default class ProductResource extends Resource {
  constructor() {
    super('/admin/products');
  }

  update(id, resource) {
    return request({
      url: this.uri + '/' + id,
      method: 'post',
      data: resource,
    });
  }

  detail(id) {
    return request({
      url: this.uri + `/${id}/detail`,
      method: 'get',
    });
  }

  getProduct() {
    return request({
      url: '/admin/products',
      method: 'get',
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
