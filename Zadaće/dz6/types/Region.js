const { GraphQLObjectType, GraphQLInt, GraphQLString, GraphQLList } = require('graphql');

const RegionType = new GraphQLObjectType({
    name: 'Region',
    fields: () => (
        {
            RegionID: { type: GraphQLInt },
            RegionDescription: { type: GraphQLString },
        }
    )
});

module.exports = RegionType;