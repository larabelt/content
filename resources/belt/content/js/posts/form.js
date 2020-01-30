import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';
import moment from 'moment';

class PostForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/posts/'});
        this.routeEditName = 'posts.edit';
        this.setData({
            id: '',
            is_active: 0,
            name: '',
            slug: '',
            subtype: '',
            body: '',
            meta_title: '',
            meta_description: '',
            meta_keywords: '',
            post_at: '',
            post_at_date: '',
            post_at_time: '',
            source_url: '',
            source_name: '',
        })
    }

    setData(data) {

        super.setData(data);

        if (this.post_at) {
            let post_at = moment(this.post_at);
            this.post_at_date = post_at.format("YYYY-MM-DD");
            this.post_at_time = post_at.format("HH:mm");
        }
    }

    data() {

        if (this.post_at_date || this.post_at_time) {
            let post_at = moment(this.post_at_date + ' ' + this.post_at_time);
            this.post_at = post_at.format("YYYY-MM-DD HH:mm:00");
        }

        return super.data();
    }
}

export default PostForm;