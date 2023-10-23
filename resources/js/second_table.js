import { useStore } from 'vuex';
import $ from 'jquery';
export default function second_table(){
	const store = useStore()
	const getFirsttable = async() => {
		try{
			let response = await axios.get('/api/show-from-first-table')
			store.dispatch('setFirstTables', response.data)
		}
		catch(error){}
	}
	const stores = async(values, { resetForm }) => {
		try{
			let response = await axios.post('/api/store-in-second-table', values)
			toastr.success(response.data.message)
			resetForm({
				values: {
					stext: undefined,
					ft_id: undefined
				}
			})
		}
		catch(error){}
	}
	const show = async() => {
		try{
			let response = await axios.get('/api/show-from-second-table')
			store.dispatch('setDatas', response.data)
			$(document).ready( function () {
				$('#table').DataTable({
					scrollX: true,
					'pagingType': 'simple',
				    'drawCallback': function( settings ) {
				        document.getElementById('table_previous').querySelector('a').innerHTML = '<i class="fa fa-angle-left"></i>'
				        document.getElementById('table_next').querySelector('a').innerHTML = '<i class="fa fa-angle-right"></i>'
				    }
				})
			})
		}
		catch(error){}
	}
	const edit = async (id) => {
		try{
			let response = await axios.get('/api/edit-from-second-table/' + id)
	        store.dispatch('setData', response.data)
			store.dispatch('setEditName', response.data.stext)
			store.dispatch('setRelatedFirstTable', response.data.firsttables)
		}
        catch(error){}
    }
    const update = async (values, { resetForm }) => {
		const formData = new FormData()
		formData.append('id', values.id)
        formData.append('stext', values.stext)
        formData.append('ft_id', values.ft_id)
		formData.append('_method', 'patch')
        try {
            let response = await axios.post('/api/update-from-second-table', formData)
            toastr.success(response.data.message)
            document.getElementById('editform').style.display = 'none'
            resetForm({
				values: {
					id: undefined,
					stext: undefined,
					ft_id: undefined,
					ft_id_empty: undefined
				}
			})
        }
        catch (error) {}
    }
	const destroy = async (id) => {
		const formData = new FormData()
		formData.append('id', id)
		formData.append('_method', 'delete')
		try{
			let response = await axios.post('/api/destroy-from-second-table', formData)
			toastr.error(response.data.message)
		}
        catch(error){}
    }
	return{
		getFirsttable,
		stores,
		show,
		edit,
		update,
		destroy
	}
}