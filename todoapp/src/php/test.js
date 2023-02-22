const app = new Vue({
    el: '#app',
    component: {
    },
    data() {
        return {
            user_name: '',
            user_pass: '',
            user_mail: '',
            user_id: 0,

            title: 'テストタイトル',
            message: 'テストメッセージ',
            group_id: 0,
            genre_id: 0,
            deadline: '',
            rank: '',
            comment: 'テストコメント',
            permission: 0,
            todo_condition: 'テスト完了条件',
            group_name: 'テストグループ',
            user_ids: [],

            todo_id:0,
            image_id:1,

            approval:false,

            title_id:0,

            title_name:'',
            title_conditions:'',
        }
    },
    //ページが読み込まれた時に動く処理
    created() {
    },
    updated() {
    },
    methods: {
        create_user() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    name: this.user_name,
                    pass: this.user_pass,
                    mail: this.user_mail,
                    create_user: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data)),

                )
        },
        create_title() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    title_name: this.title_name,
                    title_conditions: this.title_conditions,
                    create_title: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data)),

                )
        },
        loginchk() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    pass: this.user_pass,
                    mail: this.user_mail,
                    login_user: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        create_todo() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    create_todo: '',
                    title: this.title,
                    message: this.message,
                    user_id: this.user_id,
                    group_id: this.group_id,
                    genre_id: this.genre_id,
                    deadline: this.deadline,
                    rank: this.rank,
                    permission: this.permission,
                    todo_condition: this.todo_condition
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (res) {
                    console.log(res.data)

                })
        },
        request_todo() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    image_id: this.image_id,
                    todo_id: this.todo_id,
                    user_id: this.user_id,
                    request_todo: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        approval_todo() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    approval: this.approval,
                    comment:this.comment,
                    todo_id: this.todo_id,
                    user_id: this.user_id,
                    group_id: this.group_id,
                    approval_todo: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        create_group() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    name: this.group_name,
                    user_id: this.user_ids,
                    create_group: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        add_users() {
            console.log(this.user_ids.length)
            this.user_ids[this.user_ids.length] = this.user_id;
            console.log(this.user_ids)
        },
        get_username() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: this.user_id,
                    get_username: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        add_affiliation() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: this.user_id,
                    group_id:this.group_id,
                    add_affiliation: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        delete_affiliation() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: this.user_id,
                    group_id:this.group_id,
                    delete_affiliation: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        rename_group() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id: this.user_id,
                    group_id:this.group_id,
                    group_name:this.group_name,
                    rename_group: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_group_userlist() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    group_id:this.group_id,
                    get_group_userlist: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_completionlist() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    group_id:this.group_id,
                    get_completionlist: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_user_information() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:this.user_id,
                    get_user_information: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        rank_count() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:this.user_id,
                    rank_count: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_title() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:this.user_id,
                    get_title: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_user_todolist() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:this.user_id,
                    get_user_todolist: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        update_usertitle() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:this.user_id,
                    title_id:this.title_id,
                    update_usertitle: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_header() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    user_id:this.user_id,
                    get_header: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
        get_bulletinboard() {
            axios
                .post('http://mp-class.chips.jp/group_task/main.php', {
                    get_bulletinboard: ''
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(
                    (response) => (console.log(response.data))
                )
        },
    },
    computed: {
    }
});