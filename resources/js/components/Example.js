import React from 'react';
import ReactDOM from 'react-dom';

let language = window.toReact;


class LangParent extends React.Component {  
    
    constructor( props ) {
      super( props );
      console.log( '[App.js] Inside Constructor', props );
      this.sortChange = this.sortChange.bind(this);
      this.filterChange = this.filterChange.bind(this);
      this.state = {
        lang: language,
        name: this.props.name,
        products: [],
        sort: '',
        filter: ''
      };
    }
        
    componentDidMount () {
      console.log( '[App.js] Inside componentDidMount()' );
      axios.post('/products-react')
        .then(res => {
            this.setState({ products: res.data});
        }).catch(err => {
            console.log(err)
        })
    }

    static getDerivedStateFromProps(nextProps, prevState){
      console.log( '[UPDATE App.js] Inside getDerivedStateFromProps', nextProps, prevState );
      return prevState;
    }    

    sortChange(event){
      let curValue = event.target.value;
      let data = {
        sort: curValue,
        category: this.state.filter
      }
      console.log(data)
      axios.post('/products-react', data)
        .then(res => {
            this.setState({ products: res.data, sort: curValue});
        }).catch(err => {
            console.log(err)
        })
    };

    filterChange(event){
      let curValue = event.target.value;
      let data = {
        sort: this.state.sort,
        category: curValue
      }
      axios.post('/products-react',null, { params: {
        sort: this.state.sort,
        category: curValue
      }})
        .then(res => {
            this.setState({ products: res.data, filter: curValue});
            console.log(res)
        }).catch(err => {
            console.log(err)
        })
    };
  
    render() {
      let productList = this.state.products.map((product, index)=> {
        return(
          <div className="w-3/12 m-3 bg-white rounded-lg overflow-hidden shadow-lg" key={product.id}>
            <div className="flex justify-center p-3"><img src={product.image} style={{maxWidth:100 + '%', maxHeight:200 + "px"}} /></div>
            <div className="px-6 py-4">
              <div className="font-bold text-xl mb-2">{product.title}</div>
              <div className="font-bold mb-2"><div>{product.price}</div></div>
              <p className="text-gray-700 text-base">{product.description}</p>
            </div>
            <div className="px-6 py-4">
              <span className="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{product.category}</span>
            </div>
          </div>
        );
      });
      return (
        <>
          <div className="bg-white p-6 flex w-4/12 justify-between mt-6 mx-auto flex-wrap">
              <div>Before child component - name: {this.state.name}</div>
            <Example lang={this.state.lang} />
          </div>
          <div className="flex flex-wrap justify-center">
            <label className="flex flex-wrap justify-center m-3 w-3/12">
              <span className="text-gray-700 w-full">Sort</span>
              <select className="form-select mt-1 block w-full" onChange={this.sortChange} defaultValue="asc">
                <option value="asc">asc</option>
                <option value="desc">desc</option>
              </select>
            </label>
            <label className="flex flex-wrap justify-center m-3 w-3/12">
              <span className="text-gray-700 w-full">Category</span>
              <select className="form-select mt-1 block w-full" onChange={this.filterChange} defaultValue="">
                <option value="">all</option>
                <option value="men clothing">men clothing</option>
                <option value="jewelery">jewelery</option>
                <option value="electronics">electronics</option>
              </select>
            </label>
          </div>          
          <div className="flex flex-wrap justify-center">
            {productList.length > 0 ? productList : <p>No products</p>}
          </div>
        </>
      );
    }
  }

function Example(props) {
    return (
        <div className="flex justify-between w-6/12">
            <span>React component</span>
            ---
            <span>{props.lang}</span>
        </div>
    );
}


if (document.getElementById('example')) {
    ReactDOM.render(<LangParent name={window.userName} />, document.getElementById('example'));
}
