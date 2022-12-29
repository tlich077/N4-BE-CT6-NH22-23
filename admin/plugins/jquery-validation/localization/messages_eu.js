escription>
            <LongDescription _locID="longDescription.SqlCommand.ExecuteXmlReader">The command text "{0}" was executed on connection "{1}", building an XmlReader.</LongDescription>
            <DataQueries>
              <DataQuery index="0" maxSize="4096" type="String" _locID="dataquery.SqlCommand.ExecuteXmlReader.CommandText" _locAttrData="name" name="Command Text" query="_commandText" />
              <DataQuery index="0" maxSize="256" type="String" _locID="dataquery.SqlCommand.ExecuteXmlReader.ConnectionString" _locAttrData="name" name="Connection String" query="_activeConnection._userConnectionOptions._usersConnectionString" />
            </DataQueries>
            <ProgrammableDataQuery>
              <ModuleName></ModuleName>
              <TypeName></TypeName>
            </ProgrammableDataQuery>
            <AutomaticDataQuery level="None" />
          </Binding>
        </Bindings>
        <CategoryId>system.data</CategoryId>
        <SettingsName _locID="settingsName.SqlCommand.ExecuteXmlReader">ExecuteXmlReader (SQLCommand)</SettingsName>
        <SettingsDescription _locID="settingsDescription.SqlCommand.ExecuteXmlReader">Command text was executed, building an XmlReader.</SettingsDescription>
      </DiagnosticEventSpecification>
      <DiagnosticEventSpecification enabled="true">
        <Bindings>
          <Binding onReturn="true">
            <ModuleSpecificationId>system.web</ModuleSpecificationId>
            <TypeName>System.Web.ErrorFormat