Attribute VB_Name = "NewMacros"
Sub Svyat()

    Dim Numbers(9) As String
    Numbers(0) = "0"
    Numbers(1) = "1"
    Numbers(2) = "2"
    Numbers(3) = "3"
    Numbers(4) = "4"
    Numbers(5) = "5"
    Numbers(6) = "6"
    Numbers(7) = "7"
    Numbers(8) = "8"
    Numbers(9) = "9"
    
    Dim i As Integer
    
    For i = 0 To 9
        With Selection.Find
        .ClearFormatting
        .Replacement.ClearFormatting
        .Text = Numbers(i)
        .Replacement.Font.Bold = True
        .Replacement.Font.TextColor.RGB = RGB(122, 8, 160)
        .Wrap = wdFindStop
        .Execute Replace:=wdReplaceAll
        .ClearFormatting
        End With
    Next i
End Sub
